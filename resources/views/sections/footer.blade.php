<footer
    class="site-footer"
    id="site-footer"
>
    <div class="site-footer__container">
        <p>
            &copy;
            @php
                echo date('Y');
            @endphp

            {{ $siteName }}
        </p>
    </div>
</footer>
