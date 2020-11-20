/**HOME JS */


addEventListener("click", (e) => {

  //if you hit new publication then...
  if (e.target.id === "newPublication") {
    const newPublicationBody = document.getElementById("newPublicationBody");
    const newPublicationButton = document.getElementById("newPublication");

    //check if is available or not
    newPublicationBody.classList.remove("d-none");
    newPublicationBody.classList.add("d-block");
    newPublicationButton.classList.remove("d-block");
    newPublicationButton.classList.add("d-none");
  }

  //if you cancel the new publication
  if (e.target.id === "newPublicationCancel") {
    const newPublicationBody = document.getElementById("newPublicationBody");
    const newPublicationButton = document.getElementById("newPublication");

    newPublicationBody.classList.remove("d-block");
    newPublicationBody.classList.add("d-none");
    newPublicationButton.classList.remove("d-none");
    newPublicationButton.classList.add("d-block");
  }

  //if you hit a new comment button
  if (e.target.classList.contains("writeCommentButton")) {
    const newCommentBody =
      e.target.parentElement.parentElement.lastElementChild;

    newCommentBody.classList.remove("d-none");
    newCommentBody.classList.add("d-block");

    e.target.classList.add("d-none");
  }

  //if you cancel a new comment
  if (e.target.classList.contains("writeCommentCancel")) {
    const newCommentBody = e.target.parentElement.parentElement.parentElement;
    const newCommentButton =
      e.target.parentElement.parentElement.parentElement.parentElement
        .firstElementChild.firstElementChild;

    newCommentBody.classList.remove("d-block");
    newCommentBody.classList.add("d-none");
    newCommentButton.classList.remove("d-none");
  }

  //if you edit a publication
  if (e.target.classList.contains("editPublicationButton")) {
    const publicationBody = e.target.parentElement.parentElement.parentElement;
    const editPublicationForm =
      e.target.parentElement.parentElement.parentElement.parentElement
        .lastElementChild;
    const newPublicationButton = document.getElementById("newPublication");

    console.log(publicationBody);
    console.log(editPublicationForm);

    //hide body
    publicationBody.classList.add("d-none");

    //hide new publication button

    newPublicationButton.classList.remove("d-block");
    newPublicationButton.classList.add("d-none");
    //show form
    editPublicationForm.classList.remove("d-none");
  }

  //if you cancel the publication edit
  if (e.target.classList.contains("cancelEditPublication")) {
    const publicationBody =
      e.target.parentElement.parentElement.parentElement.firstElementChild;
    const editPublicationForm = e.target.parentElement.parentElement;
    const newPublicationButton = document.getElementById("newPublication");

    //hide form
    editPublicationForm.classList.add("d-none");

    //if hidden, show new publication button
    newPublicationButton.classList.remove("d-none");
    newPublicationButton.classList.add("d-block");

    //show body
    publicationBody.classList.remove("d-none");
  }


});
