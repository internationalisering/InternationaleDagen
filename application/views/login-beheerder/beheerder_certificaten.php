<?php
/**
 * @file beheerder_certificaten.php
 * 
 * Pagina waar de beheerder certificaten kan opvragen.
 */
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Certificates</h1>
        </div>

        <div class="col-lg-12">

        <button id="print">Print certificates</button>
        <hr>
        <div id="printArea">
            <?php 
            $start = date("l d F Y", strtotime($edition->startdatum));
            $eind = date("l d F Y", strtotime($edition->einddatum));

            foreach ($users as $user) {
                if ($user->typeId == 3) {
                    echo "<div id='card'><h4>Certificate of attendance</h4><p>
                    We hereby declare that, <i>" . $user->achternaam . " " . $user->voornaam . "</i>, " . $user->positie . " at " . $user->institutie .
                    " was present on <i>The International Days</i> which were held from " . $start . ", to " . $eind . "</p>
                    <p>With kind regards, Tinne Van Echelpoel</p><p><strong>Thomas More</strong></p></div><hr>";
                }
            }

            ?>
            </div>
        </div>

        

    </div>

</div>

<script type="text/javascript">
    $(function () {
    $("#print").click(function () {
        var contents = $("#printArea").html();
        var frame1 = $('<iframe />');
        frame1[0].namess = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        frameDoc.document.write('<html><head><title>Certificates</title>');
        frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
    });
</script>