<?php

use Illuminate\Support\Facades\App;use Illuminate\Support\Facades\File;

$lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
$trans = [];
foreach ($lang_files as $f) {
    $filename = pathinfo($f)['filename'];
    $trans[$filename] = trans($filename);
}
$trans = json_encode($trans);
?>
<script>
    window.trans = <?=$trans;?>;
</script>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
