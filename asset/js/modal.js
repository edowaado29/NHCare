var modal = document.getElementById('myModal');

var img = document.getElementById('profileImg');
var kk = document.getElementById('kkImg');
var ktp = document.getElementById('ktpImg');

var modalImg = document.getElementById('modalImg');

img.onclick = function() {
modal.style.display = 'block';
modalImg.src = this.src;
};

kk.onclick = function() {
modal.style.display = 'block';
modalImg.src = this.src;
};

ktp.onclick = function() {
modal.style.display = 'block';
modalImg.src = this.src;
};

var span = document.getElementsByClassName('close')[0];
span.onclick = function() {
modal.style.display = 'none';

};