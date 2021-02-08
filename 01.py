import glob
import os
import sys
import re

keepFiles={}
#HTMLからjpgのファイル名を抽出する．
for html_file  in glob.glob('**/*.html',recursive=True):
  #print(html_file)
  with open(html_file,"r") as F:
      lines = F.read()
      print(lines)
      jpg_png_Re = re.findall('\/([A-z0-9_-]+?\.(jpg|png))',lines)
      for f in jpg_png_Re: 
          keepFiles[f[0]] = keepFiles.get(f[0], 0) + 1
          #print(f[0]) 



#必要のないファイルを削除する
i=0
#for x in glob.glob('**/*.jpg',recursive=True):
for x in glob.glob('**/*.png',recursive=True):
  jpg_png_Re = re.search('\/([A-z0-9_-]+?\.(jpg|png))',x)
  if jpg_png_Re:
      f = jpg_png_Re[1]
      if f in keepFiles.keys():
          i+=1
          print()
          print(i,f)
          print(x + 'は削除しません．')
      else:
          os.remove(x)
          print(x + 'は削除しました．')
          pass
