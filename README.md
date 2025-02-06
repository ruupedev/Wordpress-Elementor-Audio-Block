# 🎵 Elementor Audio Block  
A custom Elementor audio player block that integrates with WaveSurfer.js to provide an interactive waveform-based audio player for your WordPress site.

## 🚀 Features  
📈 Waveform visualization – Uses WaveSurfer.js for an interactive audio experience.  
⏯️ Play/Pause functionality – Includes a button to control playback.  
🎨 Customizable styles – Modify colors, sizes, and layouts via CSS.  
🔊 Audio normalization – Ensures consistent playback levels.

## 📂 File Structure
```bash
/elementor-audio-block
│── elementor-audio.js      # Initializes WaveSurfer.js and handles playback
│── index.asset.php         # Metadata for WordPress block
│── index.css               # Editor-only styles
│── style-index.css         # Frontend and editor styles
│── stylesheet.css          # Audio player styles (buttons, layout)
│── view.js                 # Frontend JavaScript
```

## 🛠️ Installation & Usage  
### 1️⃣ **Install the Block**  
- Upload the files to your WordPress plugin or theme directory.  
- Register the script and enqueue it in your theme/plugin.

### 2️⃣ **Add the Block in Elementor**  
- Use the Elementor widget editor.  
- Insert the Elementor Audio Block into your page.  
- Set the audio URL as a data attribute.

## 🎛️ Customization  
### **Modify Styles**  
You can customize the player’s appearance by editing `stylesheet.css` and `style-index.css`.

### **Adjust Behavior**  
Modify `elementor-audio.js` to change how the player handles audio interactions.

## 📜 Code Breakdown  
### **elementor-audio.js**  
Manages the WaveSurfer.js player, including:
- Loading the waveform  
- Play/Pause button functionality  
- Handling the end of playback

```js
var wavesurfer = WaveSurfer.create({
    container: container,
    waveColor: 'white',
    progressColor: 'gray',
    height: 50,
    normalize: true,
});
```

### **stylesheet.css**  
Defines button and layout styles:

```css
.audio-player-container {
    display: flex;
    align-items: center;
}
.waveform-play-pause {
    background: transparent;
    border: none;
    color: white;
    cursor: pointer;
}
```

## 🎯 Future Improvements  
✅ Add volume control  
✅ Implement a seek bar  
✅ Support for multiple instances on the same page

## 🤝 Contributing  
Feel free to fork the repo and submit a pull request! 🚀

## 📄 License  
MIT License. Free to use and modify.
