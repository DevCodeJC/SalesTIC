const { src, dest, watch } = require ("gulp");
/*Para usar en paralelo
const { src, dest, watch, parallel} = require ("gulp");
*/

//CSS
const sass = require ("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");

//Imagenes
const webp = require('gulp-webp'); 
const imagemin = require('gulp-imagemin');
const cache = require('gulp-cache');

function css(callback){
    
    src('source/scss/**/*.scss') //Identificar el archivo SASS
        .pipe( plumber() )
        .pipe( sass() )         //Compilar
        .pipe( dest("css") );    //Almacenar

    callback(); //avisa cuando se llega al final d ela fuincion
}
function dev(callback){
    watch("source/scss/**/*.scss", css)
    callback();
}
function reducir(callback){
    const opciones = {
        optimizationLevel:3
    };
    src('img/initial/**/*.{png,jpg}') //Identificar los archivos con extension de imagen
    .pipe( cache(imagemin(opciones) ) ) //Almacena en cache las imagenes reducidas
    .pipe( dest('img/imgmin')) //Almacenar las imagenes reducidas de tamaño
    callback();
}
function imgwebp(callback){
    const opciones = {
        quality:50
    };
    src('img/initial/**/*.{png,jpg}') //Identificar los archivos con extension de imagen
    .pipe( webp(opciones) ) //Transformacion de imagenes
    .pipe( dest('img/webp')) //Almacenar las imagenes convertidas en webp
    callback();
}

exports.css = css;
exports.imgwebp =imgwebp; //para ejecutar: npx gulp imgwebp
exports.reducir = reducir; //para ejecutar: npx gulp reducir
exports.dev = dev; //para ejecutar: npm run dev

/*Para usar en paralelo
exports.dev = parallel(dev, imgwebp, reducir);
*/