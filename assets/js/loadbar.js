$(document).ready(function() {
  RefreshFileBox();
})

// JavaScript Document
var iFilesNeeded = 0;
var iFilesTotal = 0;
var bDownloadingFile = false;

var iDifference = 0;
var iPercentage = 0;

var countChanged = 0;
var cPer = 0;

  function SetFilesNeeded(needed, total) {
      iFilesNeeded = needed;
      RefreshFileBox();
  }

  function SetFilesTotal(total) {
      iFilesTotal = total;
      RefreshFileBox();
  }

  function DownloadingFile(filename) {
      if (bDownloadingFile) {
          iFilesNeeded = iFilesNeeded - 1;
      }
      document.getElementById("dfile").innerHTML = filename;
      bCanChangeStatus = false;
      setTimeout("bCanChangeStatus = true;", 1000);
      bDownloadingFile = true;
      RefreshFileBox();
  }

  function SetStatusChanged(status) {
      if (bDownloadingFile) {
          iFilesNeeded = iFilesNeeded - 1;
          bDownloadingFile = false;
      }
      if (status.indexOf('Found') >= 0) {
        countChanged++;
      } else if (status.indexOf('Workshop') >= 0) {
        countChanged++;
      }
      document.getElementById("dfile").innerHTML = status;
      bCanChangeStatus = false;
      setTimeout("bCanChangeStatus = true;", 1000);
      RefreshFileBox();
  }

  function RefreshFileBox() {
      iDifference = Math.round(iFilesTotal - iFilesNeeded);
      iPercentage = Math.round(iDifference / iFilesTotal * 100);

      cPer = countChanged / 66 * 100

      document.getElementById("workshopbar").style.width=cPer+'%';
      document.getElementById("fastdlbar").style.width=iPercentage+'%';
  }
