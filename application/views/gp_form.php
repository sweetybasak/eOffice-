<?php $this->load->view('backend/header1'); ?>
<body>
        <br><br>
    <main id="main">
        <section id="contact">
        <br><br>
        <p class="text-center" style="font-size: 26px;"><i class="fa fa-user-secret text-danger"></i> PASSWORD RECOVERY</p>
                                            <div class="container-fluid">
                                                <div class="row justify-content-center mt-5">
                                                    
                                                    

<?php echo validation_errors(); 
echo "Password:".form_password('password', '');

echo "Password Confirmation:".form_password('passconf','');
echo form_submit('submit','Submit');
?>

</div>
</div>
</section>
</main>
