var jData =  JSON.stringify({UserName: 'manager', Password: '1111', CompanyDB: 'SBODEMOAU'});
        connectSL();    
function connectSL(){
    $.ajax({
        // the URL for the request
        url: "https://115.84.182.179:50000/b1s/v1/Login",

        xhrFields: {
            withCredentials: true
        },
        data: jData,
        type: "POST",
        dataType : "json",
        success: function( json ) {
        },
        error: function( xhr, status, errorThrown ) {
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
        },
        complete: function( xhr, status ) {
            //alert(complete);
            // Nothing for now.
        }
        });
    }