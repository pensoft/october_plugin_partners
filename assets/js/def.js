function handleSVGMapMouseMove(event) {
    var countryCode = $(event.target).attr('country_code');
    var tooltip = document.getElementById("tooltip");
    if (!countryCode) {
        countryCode = $(event.target).parent().attr('country_code');
    }

    switch (countryCode) {
        case "AF":
        case "AX":
        case "AL":
        case "DZ":
        case "AS":
        case "AD":
        case "AO":
        case "AI":
        case "AQ":
        case "AG":
        case "AR":
        case "AM":
        case "AW":
        case "AT":
        case "AZ":
        case "BS":
        case "BH":
        case "BD":
        case "BB":
        case "BY":
        case "BE":
        case "BZ":
        case "BJ":
        case "BM":
        case "BT":
        case "BO":
        case "BQ":
        case "BA":
        case "BW":
        case "BV":
        case "BR":
        case "IO":
        case "BN":
        case "BG":
        case "BF":
        case "BI":
        case "KH":
        case "CM":
        case "CV":
        case "KY":
        case "CF":
        case "TD":
        case "CL":
        case "CN":
        case "CX":
        case "CC":
        case "CO":
        case "KM":
        case "CG":
        case "CD":
        case "CK":
        case "CR":
        case "CI":
        case "HR":
        case "CU":
        case "CW":
        case "CY":
        case "CZ":
        case "DK":
        case "DJ":
        case "DM":
        case "DO":
        case "EC":
        case "EG":
        case "SV":
        case "GQ":
        case "ER":
        case "EE":
        case "ET":
        case "FK":
        case "FO":
        case "FI":
        case "FJ":
        case "GF":
        case "PF":
        case "TF":
        case "GA":
        case "GM":
        case "GE":
        case "GH":
        case "GI":
        case "GR":
        case "GL":
        case "GD":
        case "GP":
        case "GU":
        case "GT":
        case "GG":
        case "GN":
        case "GW":
        case "GY":
        case "HT":
        case "HM":
        case "VA":
        case "HN":
        case "HK":
        case "IS":
        case "ID":
        case "IR":
        case "IQ":
        case "IM":
        case "IL":
        case "IT":
        case "JM":
        case "JP":
        case "JE":
        case "JO":
        case "KZ":
        case "KE":
        case "KI":
        case "KP":
        case "KR":
        case "KW":
        case "KG":
        case "LA":
        case "LV":
        case "LB":
        case "LS":
        case "LR":
        case "LY":
        case "LI":
        case "LT":
        case "LU":
        case "MO":
        case "MK":
        case "MG":
        case "MW":
        case "MY":
        case "MV":
        case "ML":
        case "MT":
        case "MH":
        case "MQ":
        case "MR":
        case "MU":
        case "YT":
        case "MX":
        case "FM":
        case "MD":
        case "MC":
        case "MN":
        case "ME":
        case "MS":
        case "MA":
        case "MZ":
        case "MM":
        case "NA":
        case "NR":
        case "NP":
        case "NC":
        case "FR":
        case "IN":
        case "NL":
        case "HU":
        case "IE":
        case "CA":
        case "NZ":
        case "DE":
        case "NI":
        case "NE":
        case "NG":
        case "NU":
        case "NF":
        case "MP":
        case "NO":
        case "OM":
        case "PK":
        case "PW":
        case "PS":
        case "PA":
        case "PG":
        case "PY":
        case "PE":
        case "PH":
        case "PN":
        case "PT":
        case "PR":
        case "QA":
        case "RE":
        case "RU":
        case "RW":
        case "BL":
        case "SH":
        case "KN":
        case "LC":
        case "MF":
        case "PM":
        case "VC":
        case "WS":
        case "SM":
        case "ST":
        case "SA":
        case "SN":
        case "RS":
        case "SC":
        case "SL":
        case "SG":
        case "SX":
        case "SK":
        case "SI":
        case "SB":
        case "SO":
        case "ZA":
        case "GS":
        case "LK":
        case "SD":
        case "SR":
        case "SJ":
        case "SZ":
        case "SE":
        case "SY":
        case "TW":
        case "TJ":
        case "TZ":
        case "TH":
        case "TL":
        case "TG":
        case "TK":
        case "TO":
        case "TT":
        case "TN":
        case "TR":
        case "TM":
        case "TC":
        case "TV":
        case "UG":
        case "UA":
        case "AE":
        case "UM":
        case "UY":
        case "UZ":
        case "VU":
        case "VE":
        case "VN":
        case "VG":
        case "VI":
        case "WF":
        case "EH":
        case "YE":
        case "ZM":
        case "ZW":
        case "US":
        case "GB":
        case "ES":
        case "AU":
        case "RO":
        case "CH":
        case "PL":
            break;
        default:
            return tooltip.classList.remove("active");
    }

    var x = event.clientX;
    var y = event.clientY;

    tooltip.style.left = (x + 20) + "px";
    tooltip.style.top = (y - 20) + "px";

    tooltip.innerHTML = $(event.target).attr('title');
    tooltip.classList.add("active");

}

function onPartners(pCode) {
    $.request('onPartners', {
        update: { '@componentpartners': '#mycomponentpartners',
        },
        data: { 
            code: pCode 
        },
    }).then(response => {
        $('html, body').animate({
            scrollTop: $("#mycomponentpartners").offset().top - 100
        }, 1000);
        var tooltip = document.getElementById("tooltip");
        tooltip.classList.remove("active");
    });
}
