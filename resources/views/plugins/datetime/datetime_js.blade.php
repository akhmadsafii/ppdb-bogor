<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
    integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(".datepicker").flatpickr({
        dateFormat: "d-m-Y",
    });
    $(".datetimepicker").flatpickr({
        enableTime: true,
        time_24hr: true,
        dateFormat: "d-m-Y H:i"
    });
    $(".timepicker").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
</script>
