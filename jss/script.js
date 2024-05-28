// scripts.js

document.getElementById('generatePDF').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const formElements = document.getElementById('estagioForm').elements;
    let y = 10; // Vertical position in the PDF

    for (let element of formElements) {
        if (element.type === 'text' || element.type === 'email' || element.type === 'number' || element.type === 'date') {
            const label = element.previousElementSibling.textContent;
            const value = element.value || '';

            doc.text(`${label} ${value}`, 10, y);
            y += 10; // Move down for next line
        }
    }

    doc.save('termo-de-compromisso.pdf');
});
