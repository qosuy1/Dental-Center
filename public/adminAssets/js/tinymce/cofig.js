// my config file to customize the Tinymce

tinymce.init({
    selector: ".tinymce_textarea",
    plugins: "lists advlist directionality", // Add 'directionality' plugin
    toolbar:
        "undo redo | styles | bold italic | bullist numlist | alignleft aligncenter alignright | ltr rtl", // Add RTL toggle button
    directionality: "rtl", // Force RTL by default
    language: "ar", // Load Arabic language pack (if needed)
    advlist_bullet_styles: "circle,disc,square",
    advlist_number_styles: "lower-alpha,lower-roman,upper-alpha,upper-roman",

});
