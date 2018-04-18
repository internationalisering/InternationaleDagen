<form class="col-md-4 col-md-offset-4 upload" action="<?php echo site_url();?>csv/uploadData" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
    <table>
        <tr>
            <td> Choose your file: </td>
            <td>
                <input type="file" class="form-control" name="userfile" id="userfile"  align="center"/>
            </td>
            <td>
                <div class="col-lg-offset-3 col-lg-9">
                    <button type="submit" name="submit" class="btn btn-info">Upload</button>
                </div>
            </td>
        </tr>
    </table> 
</form>

<style>

.upload {
    position: absolute;
    top:20%;
    right:0;
    left:0;
    width: 80%;
}

</style>