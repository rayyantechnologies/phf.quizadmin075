$(function () {

    var colors = {
        primary: $('.colors .bg-primary').css('background-color').replace('rgb', '').replace(')', '').replace('(', '').split(','),
        secondary: $('.colors .bg-secondary').css('background-color').replace('rgb', '').replace(')', '').replace('(', '').split(','),
        info: $('.colors .bg-info').css('background-color').replace('rgb', '').replace(')', '').replace('(', '').split(','),
        success: $('.colors .bg-success').css('background-color').replace('rgb', '').replace(')', '').replace('(', '').split(','),
        danger: $('.colors .bg-danger').css('background-color').replace('rgb', '').replace(')', '').replace('(', '').split(','),
        warning: $('.colors .bg-warning').css('background-color').replace('rgb', '').replace(')', '').replace('(', '').split(','),
    };

    var rgbToHex = function (rgb) {
        var hex = Number(rgb).toString(16);
        if (hex.length < 2) {
            hex = "0" + hex;
        }
        return hex;
    };

    var fullColorHex = function (r, g, b) {
        var red = rgbToHex(r);
        var green = rgbToHex(g);
        var blue = rgbToHex(b);
        return red + green + blue;
    };

    colors.primary = '#' + fullColorHex(colors.primary[0], colors.primary[1], colors.primary[2]);
    colors.secondary = '#' + fullColorHex(colors.secondary[0], colors.secondary[1], colors.secondary[2]);
    colors.info = '#' + fullColorHex(colors.info[0], colors.info[1], colors.info[2]);
    colors.success = '#' + fullColorHex(colors.success[0], colors.success[1], colors.success[2]);
    colors.danger = '#' + fullColorHex(colors.danger[0], colors.danger[1], colors.danger[2]);
    colors.warning = '#' + fullColorHex(colors.warning[0], colors.warning[1], colors.warning[2]);

    $('#recent').DataTable({
        dom: 'Bflrtip',
        buttons: [
            'csv', 'pdf', 'print'
        ],
        "columnDefs": [{
            "orderable": false,

        }]
    }); console.log('Hey');

    let dp = $('#dp');
    let previewBtn = $('#preview');
    let downloadBtn = $('#download');
    let getCanvas;

    previewBtn.on('click', function () {
        h2i();
    });

    function h2i() {
        html2canvas(dp, {
            onrendered: function (canvas) {
                previewBtn.append(canvas);
                getCanvas = canvas;
            }
        });
    }

    downloadBtn.on('click', function () {

        var imgageData = getCanvas.toDataURL("image/png");
        // var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
        // console.log('About to download');
        downloadBtn.attr(
            "download", "cards.png").attr(
                "href", imgageData);

    });

    function readURL(e) {
        console.log("inside");

        if (e.files && e.files[0]) {
            console.log("load");

            let reader = new FileReader();
            reader.onload = function (e) {
                console.log("load");

                $('#background').attr('src', e.target.result);
            };
            reader.readAsDataURL(e.files[0]);
        }
    }

    ///////// Input Details

    let createIMGbutton = $('#createImg');
    let title = $('#title');
    let content1 = $('#content1');
    let content2 = $('#content2');
    let titleText = $('#titleText');
    let content1Text = $('#content1Text');
    let content2Text = $('#content2Text');
    let imgInp = $('#imgInp');
    let form = $('#details');

    imgInp.change(function () {
        console.log("hry");
        readURL(this);
        console.log("hey");
    });


    form.submit(function (e) {
        e.preventDefault();

        // Collect Form Value
        let titleValue = title.val();
        let content1Value = content1.val();
        let content2Value = content2.val();

        titleText.html(titleValue);
        content1Text.html(content1Value);
        content2Text.html(content2Value);
    });


});
