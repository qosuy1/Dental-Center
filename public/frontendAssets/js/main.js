// Language Management System
const translations = {
    en: {
      welcome: "Welcome to Our Dental & Beauty Center",
      tagline: "Comprehensive care for your dental health and beauty needs",
      switch: "العربية",
      menu: {
        home: "Home",
        about: "About",
        serve: "Services",
        Pediatric: "Pediatric dentistry",
        Prosthodontics:"Prosthodontics", 
        Oral:"Oral surgery", 
        Cosmetic:"Cosmetic dentistry", 
        Endodontics:"Endodontics",
        departments: "Cases",
        blog: "Blog",
        contact: "Contact"
      },
      hero: {
        title: "Welcome to Our Dental & Beauty Center",
        tagline: "Comprehensive care for your dental health and beauty needs",
        cta: "Book an Appointment"
      },
      services: {
        title: "Our Specialized Services",
        subtitle: "Professional care for all your dental and beauty needs",
        learn_more: "Learn More",
        children: {
          title: "Pediatric dentistry",
          desc: "Gentle care for your child's dental health"
        },
        treatment: {
          title: "Dental Treatment",
          desc: "Comprehensive solutions for all dental issues"
        },
        surgery: {
          title: "Oral Surgery",
          desc: "Expert surgical procedures for complex cases"
        },
        beauty: {
          title: "Cosmetic Services",
          desc: "Enhance your natural beauty with our treatments"
        }
      },
      footer: {
        about: "About Us",
        description: "Providing exceptional dental and beauty services since 2010.",
        links: "Quick Links",
        contact: "Contact Us",
        address: "123 Medical St, Health City",
        phone: "+1 234 567 8900",
        email: "info@dentalbeauty.com",
        hours: "Mon-Fri: 9AM-6PM",
        copyright: "© 2023 DentalBeauty Center. All rights reserved."
      },
      blog: {
        title: "Latest Articles",
        subtitle: "Read our latest news and dental care tips",
        posted: "Posted",
        read_more: "Read More",
        view_all: "View All Articles",
        post1: {
          title: "5 Tips for Better Oral Health",
          excerpt: "Simple daily habits that can improve your dental health significantly."
        },
        post2: {
          title: "Preparing Your Child for First Dental Visit",
          excerpt: "How to make the first dental experience positive for your child."
        },
        post3: {
          title: "Latest Trends in Cosmetic Dentistry",
          excerpt: "Discover the newest techniques for a perfect smile."
        }
      }
    },
    ar: {
      welcome: "مرحبًا بكم في مركزنا لطب الأسنان والتجميل",
      tagline: "رعاية شاملة لصحة أسنانك واحتياجات التجميل",
      switch: "English",
      menu: {
        home: "الرئيسية",
        about: "من نحن",
        serve: "الخدمات",
        Pediatric: "طب أسنان الأطفال",
        Prosthodontics:"تعويضات سنية", 
        Oral:"الجراحة و القلع", 
        Cosmetic:"التجميل", 
        Endodontics:"المداواة اللبية",
        departments: "الأقسام",
        blog: "المدونة",
        contact: "اتصل بنا"
      },
      hero: {
        title: "مرحبًا بكم في مركزنا لطب الأسنان والتجميل",
        tagline: "رعاية شاملة لصحة أسنانك واحتياجات التجميل",
        cta: "احجز موعدًا"
      },
      services: {
        title: "خدماتنا المتخصصة",
        subtitle: "رعاية مهنية لجميع احتياجاتك في طب الأسنان والتجميل",
        learn_more: "معرفة المزيد",
        children: {
          title: "طب أسنان الأطفال",
          desc: "رعاية لطيفة لصحة أسنان طفلك"
        },
        treatment: {
          title: "علاج الأسنان",
          desc: "حلول شاملة لجميع مشاكل الأسنان"
        },
        surgery: {
          title: "جراحة الفم",
          desc: "إجراءات جراحية خبيرة للحالات المعقدة"
        },
        beauty: {
          title: "خدمات التجميل",
          desc: "عزز جمالك الطبيعي مع علاجاتنا"
        }
      },
      footer: {
        about: "من نحن",
        description: "نقدم خدمات استثنائية في طب الأسنان والجمال منذ عام 2010.",
        links: "روابط سريعة",
        contact: "اتصل بنا",
        address: "123 شارع طبي، مدينة الصحة",
        phone: "+1 234 567 8900",
        email: "info@dentalbeauty.com",
        hours: "من الاثنين إلى الجمعة: 9 صباحًا - 6 مساءً",
        copyright: "© 2023 مركز دينتال بيوتي. جميع الحقوق محفوظة."
      },
      blog: {
        title: "أحدث المقالات",
        subtitle: "اقرأ آخر أخبارنا ونصائح العناية بالأسنان",
        posted: "نشر في",
        read_more: "اقرأ المزيد",
        view_all: "عرض جميع المقالات",
        post1: {
          title: "5 نصائح لصحة فم أفضل",
          excerpt: "عادات يومية بسيطة يمكنها تحسين صحة أسنانك بشكل كبير."
        },
        post2: {
          title: "تحضير طفلك لزيارة طبيب الأسنان الأولى",
          excerpt: "كيف تجعل أول تجربة لطفلك مع طبيب الأسنان إيجابية."
        },
        post3: {
          title: "أحدث صيحات طب الأسنان التجميلي",
          excerpt: "اكتشف أحدث التقنيات للحصول على ابتسامة مثالية."
        }
      }
    }
  };
  
  document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const languageSwitcher = document.getElementById('languageSwitcher');
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mainNav = document.getElementById('mainNav');
    const html = document.documentElement;
    const welcomeText = document.querySelector('h1');
    const taglineText = document.querySelector('p');
    let currentLang = 'en';
  
    // Mobile Menu Toggle
    mobileMenuButton.addEventListener('click', () => {
      mainNav.classList.toggle('hidden');
      mainNav.classList.toggle('flex');
      mainNav.classList.toggle('flex-col');
      mainNav.classList.toggle('absolute');
      mainNav.classList.toggle('top-16');
      mainNav.classList.toggle('left-0');
      mainNav.classList.toggle('right-0');
      mainNav.classList.toggle('bg-white');
      mainNav.classList.toggle('p-4');
      mainNav.classList.toggle('shadow-md');
    });
  
    // Update all translatable elements
    function updateLanguage() {
      // Update HTML attributes
      if (currentLang === 'ar') {
        html.setAttribute('dir', 'rtl');
        html.setAttribute('lang', 'ar');
      } else {
        html.removeAttribute('dir');
        html.setAttribute('lang', 'en');
      }
      
      // Update text content
      welcomeText.textContent = translations[currentLang].welcome;
      taglineText.textContent = translations[currentLang].tagline;
      languageSwitcher.textContent = translations[currentLang].switch;
      
      // Update all elements with data-i18n attribute
      document.querySelectorAll('[data-i18n]').forEach(el => {
        const keys = el.dataset.i18n.split('.');
        let value = translations[currentLang];
        keys.forEach(key => {
          value = value[key];
        });
        el.textContent = value;
      });
    }
  
    languageSwitcher.addEventListener('click', () => {
      currentLang = currentLang === 'en' ? 'ar' : 'en';
      updateLanguage();
      localStorage.setItem('preferredLanguage', currentLang);
    });
  
    // Check for saved language preference
    const savedLang = localStorage.getItem('preferredLanguage');
    if (savedLang) {
      currentLang = savedLang;
      updateLanguage();
    }
  
    // Appointment Form Handling
    const appointmentForm = document.getElementById('appointmentForm');
    if (appointmentForm) {
      appointmentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(appointmentForm);
        const data = Object.fromEntries(formData);
        
        try {
          // In a real application, this would be an API call
          // For demo purposes, we'll simulate a successful submission
          console.log('Form submitted:', data);
          
          // Show success message
          alert(currentLang === 'en' 
            ? 'Appointment booked successfully! We will contact you soon.' 
            : 'تم حجز الموعد بنجاح! سنتواصل معك قريبًا.');
          
          // Reset form
          appointmentForm.reset();
        } catch (error) {
          console.error('Error submitting form:', error);
          alert(currentLang === 'en' 
            ? 'Error booking appointment. Please try again.' 
            : 'خطأ في حجز الموعد. يرجى المحاولة مرة أخرى.');
        }
      });
    }
  });





  
  