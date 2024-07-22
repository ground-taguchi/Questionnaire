function handleRedirect() {

    const urlPrms = new URLSearchParams( window.location.search );
    const sid = urlPrms.get( 'sid' );

    setTimeout( function() {

        if ( sid ) {
            
            window.location.href = "//oidemo.kyotogp.com/roas/?sid=" + sid;

        } else {
            
            window.location.href = "//oidemo.kyotogp.com/roas/";

        }
    }, 5000); // 5000ミリ秒 (5秒)

}

function handleRadioClick() {
    
    $('input[type="radio"]').on('click', function() {
        
        setTimeout(function() {

            $('#selectChannel').submit();

        }, 2000);

    });

}

function formatAdTable() {

    $('table.ad td').each(function() {

        var cellText = $(this).text().trim();

        if ( $.isNumeric ( cellText ) ) {

            var number = parseFloat(cellText);
            var formattedText = number.toLocaleString();
            $(this).text(formattedText);

            if ( number <= 1 ) {

                $(this).css( {'color': '#f00', 'background-color': '#ffe8e8'} );

            }
            
        }

    });
}

function autoSubmitOnChange( selector ) {

    $( selector ).on('change', function() {

        if ( $(this).val() !== "" ) {
            
            $( this ).closest('form').submit();

        }

    });

}