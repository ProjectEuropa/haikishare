<template>
  <div class="c-product__item" >
    <div class="c-product__info"><div class="c-product__name">画像</div><div class="c-product__label">必須</div></div>
    <div class="c-product__img-container">
      <input type="file" ref="file" @change="setImage" class="c-product__input-file" name="pic1"/>
      <!-- <img :src="/storage/ + pic" class="c-product__img"> -->
      <img :src="pic" class="c-product__img">
      画像
    </div>
  </div>
</template>
<script defer>
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
      const preview = document.querySelector('.c-product__img');
      if (fileImg.type.startsWith("image/")) {
        this.data.image = window.URL.createObjectURL(fileImg);
        this.data.name = fileImg.name;
        this.data.type = fileImg.type;
        console.log(this.data.image);
        console.log(this.data.name);
        console.log(this.data.type);
        preview.src = this.data.image;
      }
    },

  }
};
</script>
