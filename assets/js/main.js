let dp = $('#dp');
let previewBtn = $('#preview');
let downloadBtn = $('#download');
let getCanvas;

previewBtn.on('click', function() {
    h2i();
});

function h2i() {
    html2canvas(dp, {
        onrendered: function(canvas) {
            previewBtn.append(canvas);
            getCanvas = canvas;
        }
    });
}

downloadBtn.on('click', function() { 
     
      var imgageData = getCanvas.toDataURL("image/png"); 
    // var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    // console.log('About to download');
        downloadBtn.attr(
        "download", "phfquiz.png").attr( 
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
let color = $('#color');
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

    $('#dp').css('background-color',color.val());
    // $('#content1Text').css('color',color.val());

    // Collect Form Value
    let titleValue = title.val();
    let content1Value = content1.val();
    let content2Value = content2.val();

    titleText.html(titleValue);
    content1Text.html(content1Value);
    content2Text.html(content2Value);
    $('#optaText').html($('#opta').val());
    $('#optbText').html($('#optb').val());
    $('#optcText').html($('#optc').val());
    $('#optdText').html($('#optd').val());
});

