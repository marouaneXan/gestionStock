

$(function(){

    $(".toggle-menu").click(function(){
        $("aside").toggle("hide");
    })

    del=(id)=>{
        $("#action"+id).show();
        console.log(id);
    }

    // delete une produit


    delPro=(idPro)=>{

          const values={
            actionProduit:"deleteProduit",
            idProduit:idPro
          }

          $.ajax({
            url: "../app/api/delete.php",
            type: "POST",
            data: values,
            success: function(data){
               if(data.trim()=="success"){
                    $(".alertDelete").hide();
                    $(".isdeleted").show();
               }else{
                    $(".alertDelete").hide();
                    $(".isNotdeleted").show();
               }
            },
            error:function(){
                    $(".alertDelete").hide();
                    $(".isNotdeleted").show();
            }
        })

    }
    


    $(".annuler-pro").click(function(){
        window.location="http://localhost/briefGestion/admin/?produit";
    })



    // delete une demand

    delDemand=(idDemand)=>{
        const values={
        actionDemand:"deleteDemand",
        idDemand:idDemand
        }

        $.ajax({
            url: "../app/api/delete.php",
            type: "POST",       
            data: values,
            success: function(data){
                if(data.trim()=="success"){
                    $(".alertDelete").hide();
                    $(".isdeleted").show();
                }else{
                    $(".alertDelete").hide();
                    $(".isNotdeleted").show();
                }
            },
            error:function(){
                    $(".alertDelete").hide();
                    $(".isNotdeleted").show();
            }
        })

    }

    $(".annuler-demand").click(function(){
        window.location="http://localhost/briefGestion/admin/?domande";
    })




    // delete une client
    
    delClient=(idClient)=>{
        const values={
        actionClient:"deleteClient",
        idClient:idClient
        }

        $.ajax({
            url: "../app/api/delete.php",
            type: "POST",       
            data: values,
            success: function(data){
                if(data.trim()=="success"){
                    $(".alertDelete").hide();
                    $(".isdeleted").show();
                }else{
                    $(".alertDelete").hide();
                    $(".isNotdeleted").show();
                }
            },
            error:function(){
                    $(".alertDelete").hide();
                    $(".isNotdeleted").show();
            }
      })

    }

    $(".annuler-client").click(function(){
        window.location="http://localhost/briefGestion/admin/?client";
    })












    
    // delete une contact
    
    delContact=(idContact)=>{
        const values={
        actionContact:"deleteContact",
        idContact:idContact
        }

        $.ajax({
            url: "../app/api/delete.php",
            type: "POST",       
            data: values,
            success: function(data){
                if(data.trim()=="success"){
                    $(".alertDelete").hide();
                    $(".isdeleted").show();
                }else{
                    $(".alertDelete").hide();
                    $(".isNotdeleted").show();
                }
            },
            error:function(){
                    $(".alertDelete").hide();
                    $(".isNotdeleted").show();
            }
      })

    }

    $(".annuler-contact").click(function(){
        window.location="http://localhost/briefGestion/admin/?contact";
    })





    //  update product

    $("#btn-download").click(function(){
        $("#input-download").click();
    })

    $(".form-update").submit(function(event){
        event.preventDefault();
        $.ajax({
            url:"../app/api/update.php",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                $(".errorPro").html("");
                $(".errorPro").html(data.trim());
            },
            error:function(){
                console.log("error");
            }
        })
    })






     //  update profile of admin

     $("#btn-download-a").click(function(){
        $("#input-download-a").click();
    })

    $(".form-admin").submit(function(event){
        event.preventDefault();
        $.ajax({
            url:"../app/api/update.php",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                $(".errorPro").html("");
                $(".errorPro").html(data.trim());
            },
            error:function(){
                console.log("error");
            }
        })
    })






        //  ajouter product

        $("#btn-downloadImg").click(function(){
            $("#input-downloadImg").click();
        })

        $(".form-ajouterPro").submit(function(event){
            event.preventDefault();
            $.ajax({
                url:"../app/api/update.php",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $(".errorPro").html("");
                    $(".errorPro").html(data.trim());
                },
                error:function(){
                    console.log("error");
                }
            })
        })




        //  Login
  
        $(".form-login").submit(function(event){
            event.preventDefault();
            $.ajax({
                url:"../app/api/login.php",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if(data.trim()=="sussecc"){
                        window.location="http://localhost/briefGestion/admin/";
                    }else{
                        $(".errorPro").html("");
                        $(".errorPro").html(data.trim());
                    }
                   
                },
                error:function(){
                    console.log("error");
                }
            })
        })











 })