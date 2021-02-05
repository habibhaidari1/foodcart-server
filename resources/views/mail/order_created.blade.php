<!DOCTYPE html>
<html>
    @include('mail.includes.head')
    <body>
        <div class="container">
            <h2>Vielen Dank für Deine Bestellung!</h2>
            <p>
                Deine Bestellung ist bei uns eingegangen und wird nun
                zubereitet. Im Anhang dieser Mail befindet sich deine Rechnung.
                Wir wünschen dir einen guten Apetitt!
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
