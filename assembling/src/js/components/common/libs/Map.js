import MapCustomization from "../libs/MapGarbage.json";//подключение кастомизации карт с помощью конструктора яндекс карт

export default class Map {
    constructor({ container, center, zoom }) {
        if (!container) throw new Error("Контейнер не определён")

        this.container = container
        this.createMap(center, zoom)
    }

    static key = "ca4ab438-ce96-431f-9eb5-8441c2a35bb3"
    static ymapIsReady = false
    static isLoading = false

    static loadAPI() {
        if (!this.isLoading && !this.ymapIsReady) {
            this.loader = this.startLoad()
            return this.loader
        } else return this.loader
    }

    static startLoad() {
        return new Promise(resolve => {
            this.isLoading = true
            if (Map.ymapIsReady) {
                this.isLoading = false
                resolve("loaded")
                return
            }

            const script = document.createElement("script")
            script.src = `https://api-maps.yandex.ru/v3/?apikey=${this.key}&lang=ru_RU`
            script.addEventListener("load", async () => {
                await ymaps3.ready
                Map.ymapIsReady = true
                this.isLoading = false
                resolve("loaded")
            })
            document.body.append(script)
        })
    }

    static createCustomMarker() {
        const marker = document.createElement("div")
        marker.innerHTML = `
        <svg width="50" height="70" viewBox="0 0 50 70" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 24.7583C0 38.4319 11.1929 49.5165 25 49.5165V70C30.036 66.6158 38.6691 57.5318 43.3453 49.5165C48.0216 41.5013 50 32.7735 50 24.7583C50 11.0847 38.8071 0 25 0C11.1929 0 0 11.0847 0 24.7583Z" fill="#588534"/>
        <ellipse cx="24.9994" cy="24.0458" rx="16.0072" ry="15.8524" fill="white"/>
        </svg>
          `
        marker.className = "custom-map-marker"

        return marker
    }

    createMap(center = [37.617635, 55.755814], zoom = 16) {
        this.ymap = new ymaps3.YMap(
            this.container,
            {
                location: {
                    center,
                    zoom
                }
            },
            [
                new ymaps3.YMapDefaultSchemeLayer({
                    customization: MapCustomization //подключение кастомизации карт с помощью конструктора яндекс карт
                }),
                new ymaps3.YMapDefaultFeaturesLayer({ zIndex: 1800 })
            ]
        )
    }

    setLocation(center, zoom = 16) {
        if (!this.ymap) return

        this.ymap?.setLocation({
            center,
            zoom
        })
    }

    async addDefaultMarker(coordinates) {
        const { YMapDefaultMarker } = await ymaps3.import(
            "@yandex/ymaps3-markers@0.0.1"
        )
        this.ymap?.addChild(
            new YMapDefaultMarker({
                coordinates
            })
        )
    }

    addMarker(coordinates, content, props) {
        if (!this.ymap) return

        const marker = new ymaps3.YMapMarker(
            {
                coordinates,
                draggable: false,
                ...props
            },
            content
        )

        this.ymap.addChild(marker)
    }

    addMarkers(coordinates, content) {
        coordinates.forEach(coords => {
            this.addMarker(coords, content(coords))
        })
    }
}
