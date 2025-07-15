document.getElementById('add').addEventListener('submit', function(e){
    if (product_item.value === "") {
        alert('field is empty')
    }
    e.preventDefault()
})
