function sendOTP(){
    const email = document.getElementById('email');
    const otpverify = document.getElementsByClassName('otpverify')[0];
    let otp_val = Math.floor(Math.random()*10000);

    let emailbody = `
        <h3 style="text-align: center;">Kode OTP untuk reset password Anda</h3><br>
        <h1 style="text-align: center;">${otp_val}</h1> <br> 
        <p style="text-align: center;">Harap jangan memberikan kode ini kepada siapapun.</p>
    `;

    Email.send({
        SecureToken : "aebb595d-f2dd-440b-9f82-44d6a1a38fe1",
        To : email.value,
        From : "nhcoree@gmail.com",
        Subject : "NHCare : Kode OTP Untuk Reset Password",
        Body : emailbody
    }).then(
      message => {
        if(message === "OK"){
            alert("Kode OTP berhasil terkirim ke email anda!");
            const otp_inp = document.getElementById('otp_inp');
            const otp_btn = document.getElementById('otp-btn');
            
            otpverify.style.display = "block";
            otp_btn.addEventListener('click',()=>{
                if(otp_inp.value == otp_val){
                    alert('Kode OTP benar!');
                    window.location.href = 'reset_password.php';
                }
                else{
                    alert("Kode OTP salah!");
                }
            })
        } else{
            alert("Kode OTP gagal terkirim ke email anda!");
        }
      }
    );
}