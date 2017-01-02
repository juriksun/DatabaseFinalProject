<html>
    <head>
        <title>Shamir&Alex project</title>
        <link rel="stylesheet" ref="includes/style.css">
    </head>
    <body>
        <div id="wrapper>
            <section id = "course">
                <?php
                     require_once('addcourse.php');
                ?>
            </section>
            <section id = "class">
                <?php
                    require_once('addclassroom.php');
                ?>
            </section>
            <section id = "lecturer">
                <?php
                    require_once('addlecturer.php');
                ?>
            </section>
            <section id = "byDate">

            </section>
            <section id = tables>
                <?php
                    require_once('get_tables.php');
                ?>
            </section>
        </div>
    </body>
</html>
