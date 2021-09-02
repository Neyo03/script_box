
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader(); 
        
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
document.onreadystatechange = () => {
    if (document.readyState === 'complete') {
      console.log('DOM is ready.')
      $("#imgInp").change(function(){
        readURL(this);
    });
    }
  };
