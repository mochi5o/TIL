base_dir = Dir.getwd
puts base_dir

puts File.mtime(__FILE__)
arr = []
file_list = Dir.entries(base_dir)
file_list.each do |file|
  file = "#{file}/" if Dir.exist?("#{base_dir}/#{file}")
  arr.push file
end

p arr.sort