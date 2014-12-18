<?php
include 'connect.php';
include 'functions.php';
siteHeader("Контакти");
?>
    <div class="contact">
        <div class="wrap">
            <div class="section group">
                <div class="col span_1_of_3">
                    <div class="contact_info">
                        <h2>Намерете ни тук:</h2>

                    </div>
                    <div class="company_address">
                        <h3>Контакти :</h3>
                        <p>ул. Единствена N1</p>
                        <p>село. Злокучене</p>
                        <p>България</p>
                        <p>Мобилен:088 888888</p>
                        <p>Email: <span>office@atlas95.eu</span></p>
                    </div>
                </div>
                <div class="col span_2_of_3">
                    <div class="contact-form">
                        <h3>Свържете се с нас</h3>
                        <form method="post" action="contact.php" encytype="text/plain, charset=UTF-8">
                            <div>
                                <span><label>Име</label></span>
                                <span><input name="name" type="text" class="textbox" required></span>
                            </div>
                            <div>
                                <span><label>E-MAIL</label></span>
                                <span><input name="email" type="text" class="textbox" required></span>
                            </div>
                            <div>
                                <span><label>Телефон за връзка</label></span>
                                <span><input name="phone" type="text" class="textbox" required></span>
                            </div>
                            <div>
                                <span><label>Съобщение</label></span>
                                <span><textarea name="msg" required> </textarea></span>
                            </div>
                            <div>
                                <span><input type="submit" value="Изпрати"></span>
                            </div>
                        </form>

                    </div>

                    <!--Тук можем да сложим някви контакти или нещо от сорта-->


<?php
siteFooter($con);