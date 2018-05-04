<form action="post">
  <table>
    <tr>
      <td align="right">Van:</td>
      <td align="left"><input type="date" name="dateFrom"  value="<?php echo date('d-m-Y'); ?>"/></td>
    </tr>
    <tr>
      <td align="right">Tot:</td>
      <td align="left"><input type="date" name="dateTo"  value="<?php echo date('d-m-Y'); ?>"/></td>
    </tr>
    <tr>
      <td align="right">Aantal leerlingen:</td>
      <td align="left"><input type="text" name="aantalLeerlingen" /></td>
    </tr>
  </table>
</form>
