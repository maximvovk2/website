<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <style type="text/css">
        body {
            margin:0;
            font:18px 'PFAgoraSansPro-Thin', Arial, Helvetica, sans-serif;
            height:100%;
            min-width:320px;
            position: relative;
        }
        img {border-style:none;}
        a {
            text-decoration:none;
            color:#969696;
        }
        a:hover {text-decoration:underline;}
        ul {
            margin:0;
            padding:0;
            list-style:none;
        }
        h1, h2, h3, h4, h5, h6 {margin:0;}

            /* wrapper */
        html {
            font-size: 100%;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        a:focus {
            outline: thin dotted #333;
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px;
        }

        a:hover,
        a:active {
            outline: 0;
        }
        .row {
            margin-left: -20px;
            *zoom: 1;
        }

        .row:before,
        .row:after {
            display: table;
            line-height: 0;
            content: "";
        }

        .row:after {
            clear: both;
        }

        [class*="span"] {
            float: left;
            min-height: 1px;
            margin-left: 20px;
        }
        .container,
        .navbar-static-top .container,
        .navbar-fixed-top .container,
        .navbar-fixed-bottom .container {
            width: 95%;
        }

        .span12 {
            width: 940px;
        }

        .span11 {
            width: 860px;
        }

        .span10 {
            width: 780px;
        }

        .span9 {
            width: 700px;
        }

        .span8 {
            width: 620px;
        }

        .span7 {
            width: 540px;
        }

        .span6 {
            width: 460px;
        }

        .span5 {
            width: 380px;
        }

        .span4 {
            width: 300px;
        }

        .span3 {
            width: 220px;
        }

        .span2 {
            width: 140px;
        }

        .span1 {
            width: 60px;
        }
        .container {
            margin-right: auto;
            margin-left: auto;
            *zoom: 1;
        }

        .container:before,
        .container:after {
            display: table;
            line-height: 0;
            content: "";
        }

        .container:after {
            clear: both;
        }
        a {
            color: #0088cc;
            text-decoration: none;
        }
        section {
            display: block;
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 10px 0;
            font-family: inherit;
            font-weight: bold;
            line-height: 20px;
            color: inherit;
            text-rendering: optimizelegibility;
        }
    </style>
</head>
<body>
<section class="container">
    <?php echo $content; ?>
</section>
</body>
</html>