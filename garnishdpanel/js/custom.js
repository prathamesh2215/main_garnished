
           
    function showImg(id)
    {
         var modal = document.getElementById('myModal');
         var span = document.getElementById("closeModal");
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById(id);
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
            modal.style.display = "block";
            modal.style.margin ="unset";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        span.onclick = function() {
         modal.style.display = "none";
        } 
        // Get the <span> element that closes the modal
        
    }
    // When the user clicks on <span> (x), close the modal
            
            
