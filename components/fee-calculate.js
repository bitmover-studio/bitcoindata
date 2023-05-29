$(document).ready(function () {
    $(':button[name=AddressType]').click(function () {
        var outputID = $(this).val();
        $('aside').css('display', 'none');
        $('#' + outputID).css('display', 'block');
        $('#1' + outputID).css('display', 'block');
    })
})
var priceusd;

apisochain = function(){			 
$.getJSON("https://sochain.com/api/v2/get_info/BTC", function (response) {
    priceusd = parseFloat(response.data.price).toFixed(2)
    unconfirmed = (response.data.unconfirmed_txs).toLocaleString("en-US");
		document.getElementById("chartx").innerHTML = unconfirmed + " unconfirmed transactions";
        window.onload = calculate()
});}
var interval = window.setInterval(apisochain, 60000);

window.onload=apisochain();

calculate = function () {
    var satpbyte = document.getElementById('satpbyte').value;
    var inputs = document.getElementById('ninputs').value;
    var outputs = document.getElementById('noutputs').value;
    var bytes = (parseInt(inputs) * 148 + parseInt(outputs) * 34 + 10);
    var pricebtc = parseFloat(satpbyte * bytes / 100000000).toFixed(8)
    document.getElementById('fees').innerHTML = (bytes + " bytes");
    document.getElementById("pricebtc").innerHTML = pricebtc + " btc";
    var sbytes = parseInt(((42 + parseInt(inputs) * 272 + parseInt(outputs) * 128) / 4));
    var spricebtc = parseFloat(satpbyte * sbytes / 100000000).toFixed(8)
        document.getElementById('sfees').innerHTML = (bytes + " bytes" + " / " + sbytes + " vbytes");
    document.getElementById("spricebtc").innerHTML = spricebtc + " btc";
    var pbase = parseInt(inputs) * 64 + parseInt(outputs) * 32 + 10
        var ptotal = pbase + 2 + 107 * parseInt(inputs)
        var pvsize = parseInt((pbase * 3 + ptotal) / 4)
        var ppricebtc = parseFloat(satpbyte * pvsize / 100000000).toFixed(8)
        document.getElementById('3fees').innerHTML = (ptotal + " bytes" + " / " + pvsize + " vbytes");
    document.getElementById("3pricebtc").innerHTML = ppricebtc + " btc";

    document.getElementById("1reduction").innerHTML = parseInt((1 - (sbytes / bytes)) * 100) + "%";
    document.getElementById("1reduction2").innerHTML = parseInt((1 - (sbytes / bytes)) * 100) + "%";
    document.getElementById("3reduction").innerHTML = parseInt((1 - (pvsize / bytes)) * 100) + "%";

    if (!isNaN(priceusd)) {
        document.getElementById("priceusd").innerHTML = "&#36; " + parseFloat(priceusd * pricebtc).toFixed(2);
        document.getElementById("spriceusd").innerHTML = "&#36; " + parseFloat(priceusd * spricebtc).toFixed(2);
        document.getElementById("3priceusd").innerHTML = "&#36; " + parseFloat(priceusd * ppricebtc).toFixed(2);
    } else {
        document.getElementById("priceusd").innerHTML = "<span class='spinner-border spinner-border-sm pl-2' role='status' aria-hidden='true'></span> loading..";
        document.getElementById("spriceusd").innerHTML = "<span class='spinner-border spinner-border-sm pl-2' role='status' aria-hidden='true'></span> loading..";
        document.getElementById("3priceusd").innerHTML = "<span class='spinner-border spinner-border-sm pl-2' role='status' aria-hidden='true'></span> loading..";
    }
}
window.onload = calculate();