<?php if (isset($_SESSION['lengthofstay'])) {
  echo '<script>$(document).ready(function (){lengthstay();});</script>';
  unset($_SESSION['lengthofstay']);
} ?>
<div class="alert alert-length alert-autocloseable-length"
  style="background: #d9534f; position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
  <p style="font-size: 14px;">Cannot request permit. You have blotter record and the status unsolved.</p>
</div>