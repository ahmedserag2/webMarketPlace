function removeProduct()
{
	 jQuery.ajax({

            url:"deleteFromCart.php",
            data:'productId='+$("#Id").val()+'&quantity='+$("#quantity").val(),
            type:"POST",

            success:function(data)
            {
              showmsg("item added");
              addedToCart = true;
            }
          });
}


function reload()
{
	loaction.reload();
}