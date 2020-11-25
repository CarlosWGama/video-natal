from gtts import gTTS
#Cria o audio
tts = gTTS(text="Mozart", )
tts.save("audio.mp3")

