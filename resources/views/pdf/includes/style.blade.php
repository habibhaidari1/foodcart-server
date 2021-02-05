<style>
    @font-face {
        font-family: "Lato";
        font-style: normal;
        font-weight: 400;
        src: url({{storage_path("fonts/Lato-Regular.ttf")}}) format("truetype");
    }
    @font-face {
        font-family: "Lato";
        font-style: normal;
        font-weight: 700;
        src: url({{storage_path("fonts/Lato-Bold.ttf")}}) format("truetype");
    }

    body {
        margin-left: 24pt;
    }
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        font-size: 14px;
    }

    footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        text-align: center;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0px;
        padding: 0px;
    }
    h1 {
        font-size: 26px;
    }

    h2 {
        font-size: 18px;
        font-weight: 400;
    }
    h3 {
        padding: 0px 0px 8px 0px;
        font-size: 18px;
        font-weight: 700;
    }

    h5 {
        font-weight: 400;
        font-size: 26px;
    }

    h6 {
        font-weight: 400;
        font-size: 22px;
    }

    table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 0px;
        border-spacing: 0;
        border-collapse: collapse;
        background-color: transparent;
    }
    tr > td:last-of-type,
    tr > th:last-of-type {
        text-align: right;
    }
    th,
    td {
        border: 1px solid black;
        padding: 6px;
    }
</style>
