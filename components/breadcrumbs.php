<?php

/**
 * Server-side rendering of Bootstrap breadcrumbs and FAQ accordion from the
 * page's Schema.org JSON-LD (PHP port of breadcrumbs.js).
 *
 * JSON-LD is declared after head.php is included, so we buffer the page output
 * and post-process it once the page is complete. Call bd_start_schema_render()
 * once (head.php does this).
 */

function bd_start_schema_render(): void
{
   static $started = false;
   if ($started) return;
   $started = true;
   ob_start('bd_render_schema_html');
}

function bd_h($s): string
{
   return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

/** Find the first node with a given @type in all JSON-LD blocks. */
function bd_find_schema(string $html, string $type): ?array
{
   if (!preg_match_all('#<script[^>]+type=["\']application/ld\+json["\'][^>]*>(.*?)</script>#is', $html, $m)) {
      return null;
   }
   $isType = function ($t) use ($type) {
      return $t === $type || (is_array($t) && in_array($type, $t, true));
   };
   foreach ($m[1] as $json) {
      $data = json_decode($json, true);
      if (!is_array($data)) continue;
      if ($isType($data['@type'] ?? null)) return $data;
      $list = isset($data['@graph']) && is_array($data['@graph']) ? $data['@graph'] : (array_is_list($data) ? $data : []);
      foreach ($list as $node) {
         if (is_array($node) && $isType($node['@type'] ?? null)) return $node;
      }
   }
   return null;
}

function bd_render_breadcrumbs(array $items): string
{
   usort($items, fn($a, $b) => (int)($a['position'] ?? 0) <=> (int)($b['position'] ?? 0));
   $last = count($items) - 1;
   $out = '<nav style="--bs-breadcrumb-divider: \'&gt;\';" aria-label="breadcrumb" class="breadcrumb-nav pt-2 pb-1">'
      . '<ol class="breadcrumb mb-0 small">';
   foreach ($items as $i => $item) {
      $name = bd_h($item['name'] ?? '');
      if ($i === $last) {
         $out .= '<li class="breadcrumb-item active text-body fw-medium" aria-current="page">' . $name . '</li>';
      } else {
         $href = bd_h(is_string($item['item'] ?? null) ? $item['item'] : '#');
         $out .= '<li class="breadcrumb-item"><a href="' . $href . '" class="text-decoration-none text-body-secondary">' . $name . '</a></li>';
      }
   }
   return $out . '</ol></nav>';
}

function bd_format_answer(string $text): string
{
   $text = trim($text);
   if ($text === '') return '';
   if (preg_match('/<p[\s>]/i', $text)) return $text;
   $paras = array_values(array_filter(array_map('trim', preg_split('/\R/', $text))));
   if (count($paras) <= 1) return '<p class="mb-0">' . $text . '</p>';
   $out = '';
   foreach ($paras as $i => $p) {
      $out .= '<p class="' . ($i === count($paras) - 1 ? 'mb-0' : 'mb-2') . '">' . $p . '</p>';
   }
   return $out;
}

function bd_highlight_code_terms(string $text): string
{
   $terms = ['bech32m', 'bech32', 'P2PKH', 'P2SH'];

   usort($terms, fn($a, $b) => strlen($b) - strlen($a));
   $pattern = '/\b(' . implode('|', array_map('preg_quote', $terms)) . ')\b/';

   return preg_replace($pattern, '<code>$1</code>', $text);
}

function bd_render_faq_items(array $questions): string
{
   $out = [];
   $n = count($questions);
   foreach ($questions as $index => $q) {
      $id = $index + 1;

      $questionRaw = bd_h($q['name'] ?? '');
      $ans = $q['acceptedAnswer'] ?? '';
      $answerRaw = is_string($ans) ? $ans : (string)($ans['text'] ?? '');
      $answerFormatted = bd_format_answer($answerRaw);

      // Apply <code>
      $question = bd_highlight_code_terms($questionRaw);
      $answer   = bd_highlight_code_terms($answerFormatted);

      $border = ($index === $n - 1) ? '' : 'border-bottom border-secondary border-opacity-10';

      $out[] = <<<HTML
<div class="accordion-item bg-transparent {$border} py-2">
   <h2 class="accordion-header" id="faq{$id}">
      <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{$id}" aria-expanded="false" aria-controls="collapse{$id}">{$question}</button>
   </h2>
   <div id="collapse{$id}" class="accordion-collapse collapse" aria-labelledby="faq{$id}" data-bs-parent="#faqAccordion">
      <div class="accordion-body text-body-secondary small pt-1">{$answer}</div>
   </div>
</div>
HTML;
   }
   return implode("\n", $out);
}

function bd_render_schema_html(string $html): string
{
   // Only process full HTML documents
   if (stripos($html, '</html') === false) return $html;

   // ---- Breadcrumbs ----
   $bc = bd_find_schema($html, 'BreadcrumbList');
   $items = $bc['itemListElement'] ?? null;
   if (is_array($items) && count($items) > 1 && strpos($html, 'aria-label="breadcrumb"') === false) {
      $items = array_values($items);
      $nav = bd_render_breadcrumbs($items);
      $replaced = 0;
      $html = preg_replace_callback(
         '#(<div\b[^>]*\bid=["\']breadcrumb-container["\'][^>]*>)(\s*)(</div>)#i',
         function ($m) use ($nav) {
            return $m[1] . $nav . $m[3];
         },
         $html,
         1,
         $replaced
      );
      if (!$replaced) {
         $html = preg_replace('#(<h1\b)#i', addcslashes($nav, '\\$') . '$1', $html, 1);
      }

      // Section label (breadcrumb item 2) before the h1
      usort($items, fn($a, $b) => (int)($a['position'] ?? 0) <=> (int)($b['position'] ?? 0));
      $cat = $items[1]['name'] ?? '';
      if ($cat !== '' && preg_match('#<h1\b([^>]*)>#i', $html, $hm, PREG_OFFSET_CAPTURE)) {
         $before = substr($html, max(0, $hm[0][1] - 120), min(120, $hm[0][1]));
         if (strpos($before, 'section-label') === false) {
            $h1Tag = str_replace(' mt-5 ', ' mt-1 ', $hm[0][0]);
            $label = '<p class="section-label">' . bd_h($cat) . '</p>';
            $html = substr_replace($html, $label . $h1Tag, $hm[0][1], strlen($hm[0][0]));
         }
      }
   }

   // ---- FAQ accordion ----
   $faq = bd_find_schema($html, 'FAQPage');
   $questions = $faq['mainEntity'] ?? null;
   if (is_array($questions)) {
      if (!array_is_list($questions)) $questions = [$questions];
      $html = preg_replace_callback(
         '#<(div|article|section)\b([^>]*\bid=["\'](accordion-faq|faq-container|faqAccordion)["\'][^>]*)>\s*</\1>#i',
         function ($m) use ($questions) {
            $attrs = $m[2];
            $limit = preg_match('/data-items=["\'](\d+)["\']/', $attrs, $c) ? (int)$c[1] : 5;
            $qs = array_slice($questions, 0, $limit);
            if (!$qs) return $m[0];
            $itemsHtml = bd_render_faq_items($qs);
            $tag = $m[1];
            if ($m[3] === 'faqAccordion') {
               return "<$tag$attrs data-faq-rendered=\"true\">$itemsHtml</$tag>";
            }
            $title = preg_match('/data-title=["\']([^"\']*)["\']/', $attrs, $t) ? $t[1] : 'Frequently Asked Questions';
            if (!preg_match('/bg-body-tertiary/', $attrs)) {
               $attrs = preg_match('/class=["\']/', $attrs)
                  ? preg_replace('/class=(["\'])/', 'class=$1bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mt-5 mb-4 ', $attrs, 1)
                  : $attrs . ' class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mt-5 mb-4"';
            }
            return "<$tag$attrs data-faq-rendered=\"true\">"
               . '<p class="section-label mb-3">' . $title . '</p>'
               . '<div class="accordion accordion-flush" id="faqAccordion">' . $itemsHtml . '</div>'
               . "</$tag>";
         },
         $html,
         1
      );
   }

   return $html;
}
