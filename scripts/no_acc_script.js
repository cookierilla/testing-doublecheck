$(".btnNav").click(function (e) {
  e.preventDefault();
console.log('clicked')
  const loginModal = new bootstrap.Modal(
   $("#loginReqModal")
  );
  loginModal.show();
});
