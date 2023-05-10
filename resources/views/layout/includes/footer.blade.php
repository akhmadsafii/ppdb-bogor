@php
    $setting = json_decode(file_get_contents(storage_path('app/settings.json')), true);
@endphp
<footer class="footer text-center clearfix">
    {{ isset($setting['footer']) ? $setting['footer'] : '2022 © Developed by MSCH' }}</footer>
