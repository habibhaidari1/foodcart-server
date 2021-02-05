<!DOCTYPE html>
<html>
    @include('mail.includes.head')
    <body>
        <div class="container">
            <h2>Dein Bericht wurde erstellt</h2>
            <p>
                Dein Bericht wurde erstellt. Im Anhang dieser Mail befindet sich
                das Ergebnis.
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
