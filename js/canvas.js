
setTimeout(draw,500);
//window.onload = draw;
window.onresize = draw;

function draw(){


let el = document.getElementById('bigGraph');

  // inclu les padding, border & scrollbar.

console.log(el.offsetHeight);
console.log(el.offsetWidth);




const canvas_country = document.getElementById('canvas_country');

let width_canvas=canvas_country.offsetWidth;
let height_canvas=canvas_country.offsetHeight;

canvas_country.height=height_canvas;
canvas_country.width=width_canvas;

console.log('Country');
console.log(width_canvas);
console.log(height_canvas);
const ctx = canvas_country.getContext('2d');

const country_count = document.getElementById('country_count').innerHTML;
const country_name = document.getElementById('country_name').innerHTML;
let tmp=country_count.trim();
let country2=tmp.split(",");
let tmp2=country_name.trim();
let country1=tmp2.split(",");
let x=60;

max_value=country2[0];
ctx.fillStyle = 'rgb(254, 215, 102)';
ctx.fillRect(x, height_canvas-20, 50, -height_canvas+50);
ctx.fillStyle = 'rgb(0, 0, 0)';
ctx.font = '24px arial';
ctx.fillText(country2[0], 10, 50);
ctx.font = '16px arial';
ctx.fillText(country1[0], x, height_canvas);

let segm = width_canvas/country2.length;
console.log('segm = '+segm);
console.log(country2.length);

for (let i = 1; i < country2.length; i++) {
 let  pourcent_graph=(country2[i]*100)/max_value;
 let height=((height_canvas-30)*pourcent_graph)/100;
 ctx.fillStyle = 'rgb(254, 215, 102)';
 ctx.fillRect(x+segm, height_canvas-20, 50, -height);
ctx.fillStyle = 'rgb(0, 0, 0)';
 ctx.font = '16px arial';
 ctx.fillText(country1[i], x+segm, height_canvas);
 ctx.font = '24px arial';
 ctx.fillText(country2[i], 10, height_canvas-20-height);
 x+=segm;
}



const canvas_birth = document.getElementById('canvas_birth');
canvas_birth.height=height_canvas;
canvas_birth.width=width_canvas;
console.log(canvas_birth);
const ctx_birth = canvas_birth.getContext('2d');

let date = new Date();
let year=date.getFullYear();
const birth_date=document.getElementById('birth_user').innerHTML;
let birth_date2=birth_date.trim();
let birth_user=birth_date2.split(",");
let birth_tmp1=0;
let birth_tmp2=0;
let birth_array=[0,0,0,0,0,0];

let age_array=['15-17','18-24','25-34','35-49','50-64','65 et +']
birth_user.pop();

let segm2 = (width_canvas/age_array.length)-5;

console.log('segm2 = '+segm2);


for (var i = 0; i < birth_user.length; i++) {
  birth_user[i]=year-birth_user[i];
  if (birth_user[i]>=15&&birth_user[i]<=17) {
    birth_array[0]++;
  }

  if (birth_user[i]>=18&&birth_user[i]<=24) {
    birth_array[1]++;
  }

  if (birth_user[i]>=25&&birth_user[i]<=34) {
    birth_array[2]++;
  }

  if (birth_user[i]>=35&&birth_user[i]<=49) {
    birth_array[3]++;
  }

  if (birth_user[i]>=50&&birth_user[i]<=64) {
    birth_array[4]++;
  }

  if (birth_user[i]>=65) {
    birth_array[5]++;
  }
}
for (var i = 0; i < birth_array.length; i++) {
  if (birth_tmp1<birth_array[i]) {
    birth_tmp1=birth_array[i];
    birth_tmp2=i;
  }
}

x = 60;
// ctx_birth.scale(1,1);
ctx_birth.fillStyle = 'rgb(254, 215, 102)';
ctx_birth.fillRect(x, height_canvas-20, 50, -height_canvas+50);
ctx_birth.fillStyle = 'rgb(0, 0, 0)';
ctx_birth.font = '16px arial';
ctx_birth.fillText(age_array[birth_tmp2], x, height_canvas);
ctx_birth.font = '24px arial';
ctx_birth.fillText(birth_array[birth_tmp2], 10, 50);

for (var i = 0; i < birth_array.length; i++) {
  let  pourcent_graph=(birth_array[i]*100)/birth_tmp1;
  let height=((height_canvas-30)*pourcent_graph)/100;
  if (i!=birth_tmp2) {
    ctx_birth.fillStyle = 'rgb(254, 215, 102)';
    ctx_birth.fillRect(x+segm2, height_canvas-20, 50, -height);
    ctx_birth.fillStyle = 'rgb(0, 0, 0)';
    ctx_birth.font = '16px arial';
    ctx_birth.fillText(age_array[i], x+segm2, height_canvas);
    ctx_birth.font = '24px arial';
    ctx_birth.fillText(birth_array[i], 10, height_canvas-20-height);
    x+=segm2;
  }
}

}
