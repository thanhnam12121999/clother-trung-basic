$(document).ready(function() {
  $(".select2").select2();
  // bsCustomFileInput.init();
  $("#documents").fileinput({
    theme: "fas",
    maxFileCount: 5,
    enableResumableUpload: true,
    initialPreviewAsData: true,
    initialPreviewShowDelete: true,
    dropZoneTitle: "Kéo và thả tệp của bạn vào đây...",
    previewFileIcon: '<i class="fas fa-file"></i>',
    allowedPreviewTypes: null, // set to empty, null or false to disable preview for all types
    allowedFileExtensions: [
      "pdf",
      "doc",
      "docx",
      "ppt",
      "pptx",
      "rar",
      "zip",
      "7z",
      "tar.xz",
    ],
    previewFileIconSettings: {
      doc: '<i class="fas fa-file-word text-primary"></i>',
      ppt: '<i class="fas fa-file-powerpoint text-danger"></i>',
      pdf: '<i class="fas fa-file-pdf text-danger"></i>',
      zip: '<i class="fas fa-file-archive text-muted"></i>',
    },
    previewFileExtSettings: {
      doc: function(ext) {
        return ext.match(/(doc|docx)$/i);
      },
      ppt: function(ext) {
        return ext.match(/(ppt|pptx)$/i);
      },
      zip: function(ext) {
        return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
      },
    },
  });
});
