require('./bootstrap');
// resources/js/app.js
import '@fancyapps/fancybox/dist/jquery.fancybox.min.css';
import '@fancyapps/fancybox';
// resources/js/app.js
$(document).ready(function () {
    $('[data-fancybox="gallery"]').fancybox({
        // Opsi FancyBox, sesuaikan sesuai kebutuhan
        // Contoh:
        // buttons: ["zoom", "slideShow", "thumbs", "close"]
    });
});
// resources/js/app.js
$(document).ready(function () {
    // Inisialisasi FancyBox
    $('[data-fancybox="gallery"]').fancybox({
        // Opsi FancyBox, sesuaikan sesuai kebutuhan
        // Contoh:
        // buttons: ["zoom", "slideShow", "thumbs", "close"]
        afterShow: function (instance, current) {
            // Tambahkan tombol kembali setelah memperbesar gambar
            var backButton = $('<button class="fancybox-button fancybox-button--back" title="Kembali"></button>')
                .appendTo(current.$content)
                .on('click', function () {
                    $.fancybox.close();
                });
        }
    });
});
