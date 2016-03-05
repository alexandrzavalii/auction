@extends('app')
@section('content')
  @include('inc.header')
<!-- Full Width Image Header -->
    <header class="header-image">
        <div class="headline">
            <div class="container">
                <h1>Great Auction </h1>
                <h2>Will Knock Your Socks Off</h2>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">

        <hr class="featurette-divider">

        <!-- First Featurette -->
        <div class="featurette" id="about">
            <img class="featurette-image img-circle img-responsive pull-right" src="/imgs/about/cave.jpg">
            <h2 class="featurette-heading">The biggest mineral auction
                <span class="text-muted">since 1990</span>
            </h2>
            <p class="lead"> Our company is one of the best known sources for fine
          and rare space mineral specimens galaxywide. Our highly skilled team
          of mineralogists travel universe to bring the best of new finds
          from working mines and also the finest classic minerals from old
          collections. We have supplied the world’s top private collectors
          and Natural History Museums with the best specimens that came to
          the market since 1990.</p>
        </div>

        <hr class="featurette-divider">

        <!-- Second Featurette -->
        <div class="featurette" id="services">
            <img class="featurette-image img-circle img-responsive pull-left" src="/imgs/about/precious.jpeg">
            <h2 class="featurette-heading">Space Showrooms
                <span class="text-muted">9am to 5pm Monday to Friday</span>
            </h2>
            <p class="lead"> Our company’s purpose-built offices are based in London. We
          have a very extensive selection of minerals for viewing at our
          showrooms, and a state of the art mineral preparation (trimming
          and cleaning) laboratory. Our selection of fine minerals is
          certainly the largest on Earth. Please visit us
          at our showrooms, open from 9am to 5pm Monday to Friday.</p>
        </div>

        <hr class="featurette-divider">

        <!-- Third Featurette -->
        <div class="featurette" id="contact">
            <img class="featurette-image img-circle img-responsive pull-right" src="/imgs/about/mineral.jpg">
            <h2 class="featurette-heading">Greatest mineral society
                <span class="text-muted">Will Seal the Deal.</span>
            </h2>
            <p class="lead">  Our website is well known and very
          extensive, providing a successful way for customers to view and
          purchase minerals. The website is very easy to use with thousands
          of fine mineral specimens available online at all times. We update
          our specimens weekly with new and exciting items, and have a very
          active online news section which reports on all major events in
          the mineral world and has gained quite a following.</p>
        </div>

        <hr class="featurette-divider">

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
@endsection
