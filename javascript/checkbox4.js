const checkboxes = document.querySelectorAll('input[type="checkbox"]')
let checkedCount = 0

checkboxes.forEach((checkbox) => {
  checkbox.addEventListener('click', () => {
    if (checkbox.checked) {
      checkedCount++
    } else {
      checkedCount--
    }

    if (checkedCount > 4) {
      checkbox.checked = false
      checkedCount--
    }
  })
})

