from moviepy.editor import VideoFileClip, concatenate_videoclips, clips_array, CompositeVideoClip, ImageClip, AudioFileClip
import sys
import pathlib

baseURL = pathlib.Path(__file__).parent.absolute()

id = sys.argv[1]
audio = sys.argv[2]
foto = sys.argv[3]

#Video
clip1 = VideoFileClip(f"{baseURL}/video.mp4")
#Audio
audioclip = AudioFileClip(f"{baseURL}/{audio}.mp3")
#Foto
# fotoClip = ImageClip(f"{baseURL}/imagem.png", duration=13, transparent=True)
fotoClip = ImageClip(foto, duration=13, transparent=True)
fotoClip = fotoClip.set_audio(audioclip)
fotoClip = fotoClip.resize(width=100, height=100)
fotoClip = fotoClip.set_position((110, 150))
fotoClip = fotoClip.add_mask().rotate(40)
fotoClip = fotoClip.set_start(65)


final_clip = CompositeVideoClip([clip1,fotoClip])




final_clip.write_videofile(f"{baseURL}/../storage/app/videos/video_{id}.mp4")
