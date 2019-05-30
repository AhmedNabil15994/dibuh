<!-- Main Footer -->
<footer class="main-footer">
<br><br><br>
    <!-- Default to the left -->
    <?php $dt = \Carbon::now();
    $year=$dt->year;
    ?>
    <div class="text-center">
        <strong>{{ trans('master.copyright') }}   &copy; {{$year}} ,{{ trans('master.createdby') }} <a href="{{route('home.index')}}">{{ trans('master.company') }} </a>.</strong>

    </div>

</footer>
