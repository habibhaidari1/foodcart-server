<!DOCTYPE html>
<html>
    @include('mail.includes.head')
    <body>
        <div class="container">
            <h2>Deine Bestellung wurde storniert</h2>
            <p>
                Deine Bestellung wurde storniert. Im Anhang dieser Mail befindet
                sich die Stornorechnung.
            </p>
            <footer>
                <p>
                    {{ $meta["representative"] }} handelt im Namen von
                    {{ $meta["name"] }}<br />
                    {{ $meta["street"] }}<br />
                    {{ $meta["city"] }} {{ $meta["country"] }}
                </p>
            </footer>
        </div>
    </body>
</html>
