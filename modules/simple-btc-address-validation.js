var normalize = (s) => {  
    let x = String(s) || '';
    return x.replace(/^[\s\xa0]+|[\s\xa0]+$/g, '');
  };
  
  var check = (s) => {
    // Check for old address types
    let oldAddressRe = /^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/;
    if (oldAddressRe.test(s)) {
      return true;
    }
  
    // Check for Bech32 address
    if (s.startsWith('bc1') && s.length >= 42) {
      return true;
    }
  
    // Check for Taproot address
    if (s.startsWith('bc1p') && s.length >= 62) {
      return true;
    }
  
    return false;
  };
  
  var getEl = (id) => {
    return document.getElementById(id) || null; 
  };
  
  var elMessage = getEl('elMessage');
  var inpAddress = getEl('address');
  var amount = getEl('amount');
  
  var setMessage = (txt = '', clss = '') => {
    elMessage.className = clss;
    elMessage.innerHTML = txt;
  };
  
  var validate = (s) => {
    let className = 'text-danger';
    let textMessage = 'Invalid bitcoin address';
    
    if (!s) {
      textMessage = 'Please enter a valid bitcoin address';
    }
    
    let re = check(s);
    if (re) {
      className = 'text-success';
      textMessage = 'Bitcoin address is valid';
    }
    
    setMessage(textMessage, className);
    
    return re;
  };
  
  btnValidate.onclick = () => {
    let v = normalize(inpAddress.value);
    let result = validate(v);
    if (result) {
      inpAddress.value = v;
    }
  };
  