<template>
  <div class="c-product__item" >
    <div class="c-product__info"><div class="c-product__name">画像</div><div class="c-product__warning">必須</div></div>
    <div class="img-container">
      <input type="file" ref="file" @change="setImage" class="input" name="pic1"/>
      <input type="hidden" value="" name="pic1" class="hidden">
      <img :src="/storage/ + pic" class="img">
      画像
    </div>
  </div>
</template>
<script>
export default {
  props: [
    'pic',
  ],
  data() {
    return {
      data: {
        image: "",
        name: "",
      }
    };
  },
  methods: {
    setImage(e) {
      const files = this.$refs.file;
      const fileImg = files.files[0];
      const preview = document.querySelector('.img');
      const hidden = document.querySelector('.hidden');
      if (fileImg.type.startsWith("image/")) {
        this.data.image = window.URL.createObjectURL(fileImg);
        this.data.name = fileImg.name;
        this.data.type = fileImg.type;
        console.log(this.data.image);
        console.log(this.data.name);
        console.log(this.data.type);
        hidden.value = this.data.image;
        preview.src = this.data.image;
      }
    },

  }
};
</script>
<style>
  .img-container {
    width: 300px;
    height: 300px;
    position: relative;
  }
 .input {
   position: absolute;
   opacity: 0;
   height: 100%;
   width: 100%;
 }

 .img {
   width: 300px;
   height: 300px;
   background: #f2f2f2;
   object-fit: cover;
 }
</style>
