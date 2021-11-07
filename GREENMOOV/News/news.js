// var Art_template = document.getElementById("sampleArticle").content;
// var copy = document.importNode(Art_template, true);
// document.getElementById("section").appendChild(copy);

const section = document.getElementById("section");
var button = document.getElementById("button");
button.addEventListener('click', function createArticle(){
    var article=document.createElement("div");
    article.className = "news"
    section.append(article);
    article.innerHTML="helllooo"
});
