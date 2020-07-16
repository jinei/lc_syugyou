function check() {

  // 予定追加 START
  if (form.key.value == 'add') {
    let startTime = document.getElementById("start").value;
    let endTime = document.getElementById("end").value;

    if (startTime == "" || endTime == "") {
      Swal.fire({
        icon: 'error',
        title: '未入力の箇所があります',
      })
      return false;

      // 時間正規チェック
    } else {
      startTime = startTime.split(":")[0] + startTime.split(":")[1];
      endTime = endTime.split(":")[0] + endTime.split(":")[1];
      if (startTime <= endTime) {
        return true;
      } else {
        Swal.fire({
          icon: 'error',
          title: '時間の入力が不適切です',
        })
        return false;
      }
    }
    // 予定追加 END


    // 予定削除 START
  } else {
    const workingid = document.getElementById("workingid").value;
    if (workingid != "") {
      return true;
    } else {
      return false;
    }
  }
  // 予定削除 END

}

$('#addModal').on('show.bs.modal', function (event) {  // モーダル表示時のデータやりとり

  let data = window.Laravel.date;
  const button = $(event.relatedTarget);
  const edituserid = button.data('user');
  const editdate = button.data('day').split("-");
  const edityear = parseInt(editdate[0], 10);
  const editmonth = parseInt(editdate[1], 10);
  const editday = parseInt(editdate[2].split(" ")[0], 10);
  const editusername = data[edituserid].name;
  const editstarttime = button.data('start');
  const editendtime = button.data('end');
  const editworkindid = button.data('id');

  var modal = $(this)
  modal.find('.modal-title').text(editusername)
  modal.find('.modal-subtitle').text(edityear + "年" + editmonth + "月" + editday + "日")
  modal.find('.modal-body input#userid').val(edituserid);
  modal.find('.modal-body input#workingid').val(editworkindid);
  modal.find('.modal-body input#year').val(edityear);
  modal.find('.modal-body input#month').val(editmonth);
  modal.find('.modal-body input#day').val(editday);
  modal.find('.modal-body input#start').val(editstarttime);
  modal.find('.modal-body input#end').val(editendtime);

});
