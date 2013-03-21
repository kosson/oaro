/* Stilizare din JS pentru tabele
 */

$(document).ready(function(){
    $('tr:even').css('background','#dedede');
    $('tr:odd').css('background','#ffffff');
});


function chargeUnitsFresh(){
    var id= $('select#structura').val();
}




function chargeUnits(){
    var id = $('select#cities').val(); //incarca valoarea selectata din #cities

    $.ajax({
        url: '../libs/ajax.php',
        data: 'id='+id+'&step=1',
        success: function(data){
            $('#units').empty().append(data);   //mai intai goleste setul de optiuni si apoi adauga ce aduci
        }
    });
}



/*
$(document).ready(function(){
    $('#tara').append('<option value="3">Trei</option>');
});


$(document).ready(function(){
    $('#tara').change(function(){
        $('#tara').after('<select name="localitate" id="loca"></select');
    });
});
*/



/*
$(function(){
    var filtrari = $('#interogare');  //variabila care incarca selectorul id al ul-ului ce tine toate combourile in li-uri
    
    function refreshSelects(){
        var selects = filtrari.find('select');    //incarca in selects toti descendentii de tip <select> ai <ul>-ului #interogare incarcat in filtrari
        
        // Improve the selects with the Chose plugin
        selects.chosen();
        
        //Asculta daca se fac modificari
        selects.unbind('change').bind('change', function(){ //unbind elimina un evenimnet tip JavaScript atasat anterior de tip change apoi ataseaza un eveniment de tip change care executa o fucntie ori de cate ori evenimentul change apare
            
            //care este optiunea selectata
            var selected = $(this).find('option').eq(this.selectedIndex);   //incarca selected cu optiunea care a fost selectata din lista
            //The selectedIndex property sets or returns the index of the selected option in a dropdown list
            //.eq() Reduce the set of matched elements to the one at the specified index.
            
            //cauta atributul privind conexiunea de date
            var connection = selected.data('connection'); //.data() Store arbitrary data associated with the matched elements; .data( obj )- obj An object of key-value pairs of data to update
            
            // Removing the li containers that follow (if any)
            selected.closest('#interogare li').nextAll().remove();
            
            if(connection){ //daca avem o conexiune
                fetchSelect(connection);    //executa metoda fetchSelect
            }
            
        });
    }
    
    var working = false;

    function fetchSelect(val){

        if(working){
            return false;
        }
            
        working = true;

        $.getJSON('../libs/ajax.php',{key:val},function(r){ //Load JSON-encoded data from the server using a GET HTTP request

            var connection, options = '';

            $.each(r.items,function(k,v){

                connection = '';

                if(v){
                    connection = 'data-connection="'+v+'"';
                }

                options += '<option value="'+k+'" '+connection+'>'+k+'</option>';
            });

            if(r.defaultText){

                // The chose plugin requires that we add an empty option
                // element if we want to display a "Please choose" text

                options = '<option></option>'+options;
            }

            // Building the markup for the select section

            $('<li>\
                <select>\
                    '+ options +'\
                </select>\
             </li>').appendTo(questions);

            refreshSelects();

            working = false;
        });
    }
        
        $('#preloader').ajaxStart(function(){
            $(this).show();
        }).ajaxStop(function(){
            $(this).hide();
        });
        
        // Initially load the product select
        fetchSelect('productSelect');

    
});
*/
//We are now left with generating the actual JSON feed. 
//Notice that the fetchSelect function takes a string argument. 
//This is the key we will be passing back to PHP, denoting which set of items we want.
//fetchSelect loops through the items and uses the keys as content of the option elements, and the values as connections.

//{
//    "items": {
//        "Phones": "phoneSelect",
//        "Notebooks": "notebookSelect",
//        "Tablets": ""
//    },
//    "title": "What would you like to purchase?",
//    "defaultText": "Choose a product category"
//}

//$(document).ready(function(){
//    $('#cities').change(function(){
//        var id = $('select#cities').val();
//        var valoare = $('#cities option:selected').text();
//        $('#cities').after(id+ ' '+valoare);
//    });
//});