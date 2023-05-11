<style>
    .heading-page {
        /* background: url("https://d36ai2hkxl16us.cloudfront.net/thoughtindustries/image/upload/a_exif,c_fill,w_750,h_361/v1426633725/eq54w9myfn6xfd28p92g.jpg") no-repeat; */
        background-position: center;
        background-size: inherit;
        background-attachment: fixed;
        height: 361px;
        position: relative;
        text-align: center;
    }

    .heading-page::before {
        content: "";
        display: block;
        filter: blur(1px) brightness(30%);
        position: absolute;
        left: 10px;
        top: 10px;
        right: 10px;
        bottom: 10px;
        background: inherit;
        z-index: 0;
    }

    .content {
        position: relative;
        z-index: 8;
    }

    .title {
        font-family: arial;
        font-size: 3em;
        font-weight: 900;
    }

    .text {
        font-family: arial;
        font-size: 2em;
        font-weight: 100;
        display: inline-block;
        width: 40%;
    }

</style>
@if ($banner && $banner['file'] != null)
    {{-- <section class="heading-page header-text"> --}}
    <section class="heading-page header-text" id="top"
        style="background-image: url({{ asset('thumb/' . $banner['file']) }})">
        <div class='container'>
            <div class="content pt-5">
                <div class="text pt-5 pb-0 text-white">Kategori</div>
                <div class="title text-yellow">{{ session('title') }}</div>
            </div>
        </div>
    </section>
@else
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card widget-holder">
                <div class="card-body">
                    <div class="text-center text-danger">
                        <i class="far fa-image fa-5x"></i>
                        <h5>Banner tidak terpasang</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
