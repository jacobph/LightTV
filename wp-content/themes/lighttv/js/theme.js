/* MEDIABOX STUFF */
document.addEventListener("DOMContentLoaded", function() {
  console.log('DOMContentLoaded');
  MediaBox('.mediabox');
});



// // callback to handle the results
// function dataHandler(data) {
//   jQuery(document.body).append(`<h1>Found jQuery{data.length} results for station ID jQuery{zipCode}:</h1>`);
//   jQuery.each(data, function(index, result) {
//     var resultData = '<div class="tile"><b>';
//     resultData += result.program.title;
//     resultData += "</b><br><pre><code>" + JSON.stringify(result, null, 4) + "</code></pre></div>"
//     jQuery(document.body).append(resultData);
//   });
// }
