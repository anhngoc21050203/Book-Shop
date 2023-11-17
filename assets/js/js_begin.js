function displayImage() {
    var input = document.getElementById('thumbnailInput');
    var preview = document.getElementById('thumbnailPreview');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
    }
}
function displayImages() {
    var input = document.getElementById('thumbnailsInput');
    var imagePreview = document.getElementById('imagePreview');
    imagePreview.innerHTML = '';

    if (input.files && input.files.length > 0) {
        for (var i = 0; i < input.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.width = 100;
                imagePreview.appendChild(img);
            };
            reader.readAsDataURL(input.files[i]);
        }
    }
}
