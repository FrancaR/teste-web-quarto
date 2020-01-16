<template>
  <GmapMap
    :center="center"
    :zoom="zoom"
    :options="{
      zoomControl: true,
      mapTypeControl: false,
      scaleControl: false,
      streetViewControl: false,
      rotateControl: false,
      fullscreenControl: true,
      disableDefaultUi: false
    }">
    <GmapInfoWindow
      :options="infoOptions"
      :position="infoWindowPos"
      :opened="infoWinOpen"
      @closeclick="infoWinOpen=false"
    ></GmapInfoWindow>

    <GmapMarker
      :key="i"
      v-for="(m,i) in markers"
      :position="m.position"
      :clickable="true"
      @click="toggleInfoWindow(m,i)"
    ></GmapMarker>
  </GmapMap>
</template>

<script>

export default {
  props: {
    center: null,
    markers: null,
    zoom: {
      default: 7,
      required: false
    }
  },
  data: function () {
    return {
      infoWindowPos: null,
      infoWinOpen: false,
      currentMidx: null,
      infoOptions: {
        content: "",
        pixelOffset: {
          width: 0,
          height: -35
        }
      },
    }
  },
  methods: {
    toggleInfoWindow: function(marker, idx) {
      this.infoWindowPos = marker.position;
      this.infoOptions.content = marker.infoText;

      //check if its the same marker that was selected if yes toggle
      if (this.currentMidx == idx) {
        this.infoWinOpen = !this.infoWinOpen;
      }
      //if different marker set infowindow to open and reset current marker index
      else {
        this.infoWinOpen = true;
        this.currentMidx = idx;
      }
    }
  },
};
</script>